import '../styles/faq.scss';

var req = require.context('./', true, /^(.*\.(js$))[^.]*$/im);
var module = './' + wei.route + '.js';

if (req.keys().indexOf(module) !== -1) {
  const container = new (req(module).default);
  container.render();
} else {
  throw new Error('Route "' + wei.route + '" not found');
}
