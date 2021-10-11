import {Component} from 'react';
import {Button, Card, Divider, Empty, Skeleton, Space} from "antd";
import {Create} from "../Modals/Monitor/Create";
import {PlusOutlined} from "@ant-design/icons";
import LastMetrics from "../Modals/Metric/LastMetrics";

export default class Dashboard extends Component {
    constructor(props) {
        super(props);
        this.state = {
            selectedMonitor: null,
            selectedMonitorView: '',
            monitors: null,
            modals: {
                monitor_create: false,
            }
        };
    }

    componentDidMount() {
        window.axios.get('/api/monitors').then((response) => {
            this.setState({
                monitors: response.data
            });
        })
    }

    renderMonitorList() {
        return this.state.monitors.map((monitor) => {
            return (
                <div className="p-3 flex items-center hover:bg-gray-100 cursor-pointer" onClick={() => {
                    console.log(monitor)
                    this.setState({
                        selectedMonitor: monitor,
                        selectedMonitorView: (
                            <>
                                <h2 className="mb-0">
                                    {monitor.name}
                                </h2>
                                <h3>
                                    <a href={monitor.address} target="_blank">
                                        {monitor.address}
                                    </a>
                                </h3>
                                <div>
                                    <Space>
                                        <Button type="primary">Pause</Button>
                                        <Button type="primary">Edit</Button>
                                        <Button type="primary" danger>Delete</Button>
                                    </Space>
                                </div>
                                <div className="py-3">
                                    <LastMetrics metrics={monitor.last_metrics} size="xl" count={25} />
                                </div>
                            </>
                        ),
                    });
                }}>
                    <div>
                        {monitor.name}
                    </div>
                    <LastMetrics metrics={monitor.last_metrics} className="ml-auto" />
                </div>
            );
        });
    }

    openMonitorCreateModal() {
        this.setState({
            modals: {
                monitor_create: true,
            }
        });
    }

    closeMonitorCreateModal() {
        this.setState({
            modals: {
                monitor_create: false,
            }
        });
    }

    render() {
        return (
            <div className="mx-1 lg:mx-3 xl:mx-6 py-6">
                <Create visible={this.state.modals.monitor_create} onCancel={() => {this.closeMonitorCreateModal()}} />
                <div className="w-full flex flex-wrap">
                    <div className="w-full lg:w-1/3 xl:w-1/4 p-2">
                        <Button onClick={() => {this.openMonitorCreateModal()}} type="dashed" block icon={<PlusOutlined />}>Add New Monitor</Button>
                        <Divider />
                        <Card>
                            {this.state.monitors === null ? (
                                <Skeleton active />
                            ) : this.renderMonitorList()}
                        </Card>
                    </div>
                    <div className="w-full lg:w-2/3 xl:w-3/4 p-2">
                        {this.state.monitors === null ? <Skeleton active /> : ((this.state.monitors.length < 1) ? (
                            <Empty description="No any monitors exists">
                                <Button type="primary" onClick={() => {this.openMonitorCreateModal()}}>Create Now</Button>
                            </Empty>
                        ) : this.state.selectedMonitorView)}
                    </div>
                </div>
            </div>
        );
    }
}
