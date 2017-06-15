import React from 'react';
import { Router, Route } from 'dva/router';
import IndexPage from './routes/IndexPage';
import HeaderComponent from './components/header';

function RouterConfig({ history }) {
  return (
    <div>
      <HeaderComponent />
      <Router history={history}>
        <Route path="/" component={IndexPage} />
        <Route path="/a" component={HeaderComponent} />
      </Router>
    </div>
  );
}

export default RouterConfig;
