import '../styles/faq.scss';

import FaqsIndex from './faqs/index';

const maps = {
  'faqs/index': FaqsIndex,
};

if (maps[wei.route]) {
  const container = new maps[wei.route];
  container.render();
} else {
  throw new Error('Container "' + wei.route + '" not found');
}
