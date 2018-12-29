import axios from 'axios';

import { API_BASE_URL, API_TIMEOUT } from './constants';

export default axios.create({
  baseURL: API_BASE_URL,
  headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
  timeout: API_TIMEOUT,
});
