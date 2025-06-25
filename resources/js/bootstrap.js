// resources/js/bootstrap.js

import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Optional: Alpine.js (nếu cần interactivity nhẹ)
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
