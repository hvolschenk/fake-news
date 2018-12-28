import { combineReducers } from 'redux';

import application from './application';
import ui from './ui';

export default combineReducers({ application, ui });
