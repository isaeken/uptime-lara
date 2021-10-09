import React, {Component} from "react";
import Modal from "antd/es/modal/Modal";
import {Skeleton} from "antd";

export default class Create extends Component {
    constructor(props) {
        super(props);
        this.state = {
            content: <Skeleton active />,
        }
    }

    // componentDidMount() {
    //     this.setState({
    //         content: (
    //             <>
    //                 <Form>
    //                     <Form.Item>
    //                         <Select>
    //                             <Select.Option>http</Select.Option>
    //                         </Select>
    //                     </Form.Item>
    //                 </Form>
    //                 <div>
    //                     monitor type
    //                 </div>
    //                 <div>
    //                     friendly name
    //                 </div>
    //                 <div>
    //                     url
    //                 </div>
    //                 <div>
    //                     heartbeat interval
    //                 </div>
    //                 <div>retries</div>
    //                 <div>heartbeat retry interval</div>
    //                 <div>upside down mode</div>
    //                 <div>max redirects</div>
    //                 <div>accepted status codes</div>
    //                 <div>tags</div>
    //             </>
    //         ),
    //     });
    // }

    render() {
        return (
            <Modal title="Create New Monitor" {...this.props}>
                {this.state.content}
            </Modal>
        );
    }
}
