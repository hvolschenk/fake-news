import action from 'payload-action-creator';

export const UI_DIRECTION_TOGGLE = 'UI_DIRECTION_TOGGLE';
export const UI_LEFT_NAVIGATION_TOGGLE = 'UI_LEFT_NAVIGATION_TOGGLE';

export const uiDirectionToggle = action(UI_DIRECTION_TOGGLE);
export const uiLeftNavigationToggle = action(UI_LEFT_NAVIGATION_TOGGLE);
