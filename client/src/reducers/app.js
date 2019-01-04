import { combineReducers } from 'redux';

import application from './application';
import question from './question';
import ui from './ui';
import user from './user';

export default combineReducers({ application, question, ui, user });
