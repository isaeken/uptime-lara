import {Component} from 'react';
import {Button, Card, Divider, Empty, Skeleton} from "antd";
import {PlusOutlined} from "@ant-design/icons";

export default class Dashboard extends Component {
    constructor(props) {
        super(props);
        this.state = {
            monitors: null,
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
            console.log(monitor)
            return (
                <div className="p-3 flex items-center hover:bg-gray-100">
                    <div>
                        {monitor.name}
                    </div>
                    <div className="flex ml-auto space-x-1">
                        {monitor.last_metrics.map((metric) => {
                            let className = "w-1 h-5 rounded ";
                            return (
                                <div className={metric.up ? className + "bg-green-400" : className + "bg-red-400"}>

                                </div>
                            )
                        })}
                    </div>
                </div>
            );
        });
    }

    render() {
        return (
            <div className="mx-1 lg:mx-3 xl:mx-6 py-6">
                <div className="w-full flex flex-wrap">
                    <div className="w-full lg:w-1/3 xl:w-1/4 p-2">
                        <Button type="dashed" block icon={<PlusOutlined />}>Add New Monitor</Button>
                        <Divider />
                        <Card>
                            {this.state.monitors === null ? (
                                <Skeleton active />
                            ) : this.renderMonitorList()}
                        </Card>
                    </div>
                    <div className="w-full lg:w-2/3 xl:w-3/4 p-2">
                        <Empty description="No any monitors exists">
                            <Button type="primary">Create Now</Button>
                        </Empty>
                    </div>
                </div>
            </div>
        );
    }
}
