/**
 * @file
 */

import React, { Component } from 'react';
import logo from './drupal-logo.png';
import './App.css';
import ArticleList from './ArticleList';
import DrupalSettingsWidget from './DrupalSettingsWidget';

class App extends Component {
  render() {
    return (
      < div className = "App" >
        < header className = "App-header" >
          < img src = {logo} className = "App-logo" alt = "logo" / >
          < h1 className = "App-title" > Welcome to Headless Drupal! < / h1 >
        < / header >
        < DrupalSettingsWidget / >
      < / div >
    );
  }
}

export default App;
