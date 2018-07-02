import React from 'react';
import ReactDOM from "react-dom";
import Loadable from "react-loadable";
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import App from 'app';

const app = new App();

const Loading = () => <div>Loading...</div>;

const Index = Loadable({
  loader: () => import('./faqs/Index'),
  loading: Loading,
});

const NoMatch = () => <div>404</div>;

const ReactApp = () => (
  <Router>
    <Switch>
      <Route exact path={$.url('faqs')} component={Index}/>
      <Route component={NoMatch}/>
    </Switch>
  </Router>
);

export default ReactApp;
