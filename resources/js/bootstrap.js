import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import jQuery from 'jquery';
window.$ = jQuery;

import tippy from 'tippy.js';
window.tippy = tippy;

import datetimepicker from 'jquery-datetimepicker';
window.datetimepicker = datetimepicker;

import Chart from 'chart.js/auto';
window.Chart = Chart;
