import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import Parse from 'parse';
import App from './App';
import reportWebVitals from './reportWebVitals';

Parse.CoreManager.setStorageController(Parse.IndexedDB);
Parse.initialize(process.env.REACT_APP_APP_ID, process.env.REACT_APP_JS_KEY);
Parse.serverURL = 'https://parseapi.back4app.com/';

ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById('root'),
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
