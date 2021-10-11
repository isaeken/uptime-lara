import {Component} from "react";
import {Tooltip} from "antd";

export default class LastMetrics extends Component {
    render() {
        let containerClass = "flex w-full";
        let itemContainerClass = "px-0.5";
        let itemClass = "w-1 h-5 rounded";
        let count = this.props.count ?? 10;
        let metrics = this.props.metrics;

        if (this.props.size === 'xl') {
            itemContainerClass = "px-1.5";
            itemClass = "w-3 h-10 rounded-lg";
        }

        itemClass = itemClass + ' ';
        metrics = metrics.slice(-count);

        return (
            <div {...this.props}>
                <div className={containerClass}>
                    {metrics.map((metric) => {
                        let item = <div className={itemClass + "bg-gray-400"} />;
                        let tooltip = "No Data";
                        if (metric !== null) {
                            item = (<div className={metric.up ? itemClass + "bg-green-400" : itemClass + "bg-red-400"} />)
                            tooltip = (metric.up ? "UP" : "DOWN") + " " + (new Date(metric.created_at).toLocaleDateString(undefined, { year: "numeric", month: "long", day: "numeric", hour: "numeric", minute: "numeric" }));
                        }

                        return (
                            <Tooltip placement="top" title={tooltip}>
                                <div className={itemContainerClass}>
                                    {item}
                                </div>
                            </Tooltip>
                        );
                    })}
                </div>
            </div>
        )
    }
}
