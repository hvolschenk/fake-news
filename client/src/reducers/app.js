import { combineReducers } from 'redux';

import action from './action';
import application from './application';
import question from './question';
import restart from './restart';
import ui from './ui';
import user from './user';

export default combineReducers({ action, application, question, restart, ui, user });
