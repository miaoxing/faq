import React from 'react';
import ReactDOM from "react-dom";
import Loadable from "react-loadable";
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';

const Loading = () => <div>Loading...</div>;

const Index = Loadable({
  loader: () => import('./faqs/index'),
  loading: Loading,
});

const NoMatch = () => <div>404</div>;

const App = () => (
  <Router>
    <Switch>
      <Route exact path={$.url('faqs')} component={Index}/>
      <Route component={NoMatch}/>
    </Switch>
  </Router>
);

export default App;
