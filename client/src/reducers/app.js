import { combineReducers } from 'redux';

import application from './application';
import ui from './ui';
import user from './user';

export default combineReducers({ application, ui, user });
