/**
 * @file
 */

import React, { Component } from 'react';
import './App.css';
import ExampleRESTItems from "./ExampleRESTItems";

class App extends Component {
  render() {
    return (
      < div className = "example-rest-react-block-js-wrapper" >
        < ExampleRESTItems source = {"/api/react-components/example"} / >
      < / div >
    );
  }
}

export default App;
