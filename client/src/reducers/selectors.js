export const currentUrl = (state, ownProps) => ({ currentUrl: ownProps.location.pathname });
export const urlParameters = (state, ownProps) => ({ urlParameters: ownProps.match.params });
