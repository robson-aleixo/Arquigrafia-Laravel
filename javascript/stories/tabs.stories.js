import { storiesOf } from '@storybook/vue';
import { action } from '@storybook/addon-actions';
import { linkTo } from '@storybook/addon-links';

import Tabs from '../components/general/Tabs.vue';

export const tabProps = [
  {
    id: 'reviews',
    name: 'Revisões',
    href: '#reviews',
  },
  {
    id: 'editions',
    name: 'Edições',
    href: '#editions',
  },
  {
    id: 'moderation',
    name: 'Moderação',
    href: '#moderation',
    hidden: true,
    locked: true,
  },
  {
    id: 'curatorship',
    name: 'Curadoria',
    href: '#curatorship',
    hidden: true,
    locked: true,
  },
];

storiesOf('Tabs', module)
  .add('Tabs', () => ({
    components: { Tabs },
    data() {
      return {
        tabProps,
      };
    },
    template: '<Tabs :tabProps="tabProps" selectedTab="reviews" :changeTab="action" />',
    methods: { action: action('clicked') },
  }))
