/**
 * @file
 */

import React, { Component } from 'react';

class DrupalSettingsWidget extends Component {
  isset() {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: FremyCompany
    // +   improved by: Onno Marsman
    // +   improved by: Rafał Kukawski
    // *     example 1: isset( undefined, true);
    // *     returns 1: false
    // *     example 2: isset( 'Kevin van Zonneveld' );
    // *     returns 2: true.
    var a = arguments,
      l = a.length,
      i = 0,
      undef;

    if (l === 0) {
    throw new Error('Empty isset');
    }

    while (i !== l) {
    if (a[i] === undef || a[i] === null) {
      return false;
      }
      i++;
    }
    return true;
  }

  constructor(props) {
    super(props);
    // Setting up initial state
    /*eslint-disable no-undef*/
    var stringFromDrupal = "(trying to load now....)";
    if (typeof drupalSettings.hello_world_react_block.test !== "undefined") {
      stringFromDrupal = drupalSettings.hello_world_react_block.test;
    }
    this.state = {
      drupalsetting: stringFromDrupal,
    }
    /*eslint-enable no-undef*/

  }

  render() {
    return (
      < div className = "drupalSettingsWidget" >
        < p > Here is a setting from Drupal: {this.state.drupalsetting} < / p >
      < / div >
    );
  }
}

export default DrupalSettingsWidget;
