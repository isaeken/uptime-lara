import Alpine from 'alpinejs';
import ReactDOM from 'react-dom';
import Dashboard from "./Pages/Dashboard";

require('./bootstrap');

window.Alpine = Alpine;

Alpine.start();

ReactDOM.render(<Dashboard />, document.getElementById('dashboard'));
