import http from './instance';

export const deleteAsync = ({ url }) => http.delete(url);
export const getAsync = ({ options, url }) => http.get(url, options);
export const postAsync = ({ payload, url }) => http.post(url, payload);
export const putAsync = ({ payload, url }) => http.put(url, payload);
