import { storiesOf } from '@storybook/vue';
import { action } from '@storybook/addon-actions';
import { linkTo } from '@storybook/addon-links';

import OutlineButton from '../components/general/OutlineButton.vue';

storiesOf('Button', module)
  .add('OutlineButton', () => ({
    components: { OutlineButton },
    template: '<OutlineButton :handlePressButton="action" label="Outline Button" />',
    methods: { action: action('clicked') },
  }))
