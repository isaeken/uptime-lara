import React, {useEffect, useState} from 'react';
import {Checkbox, Divider, Form, Input, InputNumber, message, Modal, Select} from 'antd';
import collect from "collect.js";

function renderCustomItem(component) {
    if (component.type === 'string') {
        return (
            <Form.Item label={component.label}
                       name={component.key}
                       rules={[
                           {
                               required: component.required,
                           },
                       ]}>
                <Input placeholder={component.label} />
            </Form.Item>
        );
    }
    else if (component.type === 'integer') {
        return (
            <Form.Item label={component.label}
                       name={component.key}
                       rules={[
                           {
                               required: component.required,
                           },
                       ]}>
                <InputNumber placeholder={component.label} />
            </Form.Item>
        );
    }
    else if (component.type === 'select') {
        return (
            <Form.Item label={component.label}
                       name={component.key}
                       rules={[
                           {
                               required: component.required,
                           },
                       ]}>
                <Select>
                    {component.options.map((item) => {
                        return (
                            <Select.Option key={item.key}>
                                {item.label}
                            </Select.Option>
                        );
                    })}
                </Select>
            </Form.Item>
        );
    }

    return '';
}

export const Create = ({ visible, onCreate, onCancel }) => {
    const [form] = Form.useForm();
    const [monitorTypes, setMonitorTypes] = useState([
        {
            key: "http",
            label: "HTTP",
            inputs: [
                {
                    key: "url",
                    label: "URL",
                    required: true,
                    defaultValue: "https://isaeken.com.tr",
                    type: "string",
                }
            ],
        },
    ]);
    const [statusCodes, setStatusCodes] = useState([
        "100-199",
        "200-299",
        "300-399",
        "400-499",
        "500-599",
    ]);
    let monitorType = 'http';
    const [components, setComponents] = useState(collect(monitorTypes).where('key', monitorType).first().inputs);

    useEffect(() => {
        window.axios.get('/api/monitor-types').then((response) => {
            setMonitorTypes(response.data);
        });

        for (let i = 100; i < 1000; i++) {
            statusCodes.push(i.toString());
        }
    }, []);

    return (
        <Modal
            visible={visible}
            title="Create a new collection"
            okText="Create"
            cancelText="Cancel"
            onCancel={onCancel}
            onOk={() => {
                form
                    .validateFields()
                    .then((values) => {
                        message.loading({content: 'Creating monitor...', key: 'monitor_create_status'});
                        window.axios.post('/api/monitors', values).then((response) => {
                            form.resetFields();
                            message.success({
                                content: 'Monitor is created.',
                                key: 'monitor_create_status',
                                duration: 2,
                            });
                            onCancel();
                            window.location.reload();
                        }).catch((error) => {
                            message.error({
                                content: error.response.data.message,
                                key: 'monitor_create_status',
                                duration: 2,
                            });
                        });
                    })
                    .catch((info) => {
                        console.log('Validate Failed:', info);
                    });
            }}
        >
            <Form
                form={form}
                layout="vertical"
                name="form_in_modal"
                initialValues={{
                    monitor_type: 'http',
                    friendly_name: '',
                    heartbeat_interval: 60,
                    max_redirects: 3,
                    accepted_status_codes: "200-299",
                }}
            >
                <div>
                    <Form.Item label="Monitor Type"
                               name="monitor_type"
                               rules={[
                                   {
                                       required: true,
                                       message: 'Please select a type!',
                                   },
                               ]}>
                        <Select onChange={(key) => {
                            setComponents(collect(monitorTypes).where('key', key).first().inputs);
                        }}>
                            {monitorTypes.map((monitorType) => {
                                return (
                                    <Select.Option key={monitorType.key}>
                                        {monitorType.label}
                                    </Select.Option>
                                );
                            })}
                        </Select>
                    </Form.Item>

                    <Form.Item label="Friendly Name"
                               name="friendly_name"
                               rules={[
                                   {
                                       required: true,
                                       message: 'Please input the name of monitor!',
                                   },
                               ]}>
                        <Input placeholder="Friendly Name" />
                    </Form.Item>

                    {components.map((component) => renderCustomItem(component))}

                    <Form.Item label="Heartbeat Interval"
                               name="heartbeat_interval"
                               rules={[
                                   {
                                       required: true,
                                       message: 'Please input the heartbeat interval!',
                                   },
                               ]}>
                        <InputNumber placeholder="Heartbeat Interval" min={60} />
                    </Form.Item>
                </div>
                <Divider />
                <div>
                    <div className="mb-4 text-lg">
                        Advanced
                    </div>
                    <div>
                        <Form.Item name="upside_down_mode">
                            <Checkbox>
                                <div>Upside Down Mode</div>
                                <div className="text-xs text-gray-500">
                                    Flip the status upside down. If the service is reachable, it is DOWN.
                                </div>
                            </Checkbox>
                        </Form.Item>

                        <Form.Item label="Max. Redirects"
                                   name="max_redirects"
                                   rules={[
                                       {
                                           required: true,
                                           message: 'Please input the max redirects!',
                                       },
                                   ]}>
                            <InputNumber placeholder="Max. Redirects" min={0} max={10} />
                        </Form.Item>

                        <Form.Item label="Accepted Status Codes"
                                   name="accepted_status_codes"
                                   rules={[
                                       {
                                           required: true,
                                           message: 'Please input the accepted status codes!',
                                       },
                                   ]}>
                            <Select mode="tags" style={{ width: '100%' }} placeholder="Accepted Status Codes">
                                {statusCodes.map((code) => {
                                    return (
                                        <Select.Option key={code}>
                                            {code}
                                        </Select.Option>
                                    );
                                })}
                            </Select>
                        </Form.Item>
                    </div>
                </div>
            </Form>
        </Modal>
    );
};
