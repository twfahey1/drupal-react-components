/**
 * @file
 */

import axios from 'axios';
import React from 'react';

class ArticleList extends React.Component {
// Using ES6 class syntax.
  constructor(props) {
    super(props);
    // Setting up initial state.
    this.state = {
      title: "ONE SECOND PLEASE...",
      body: "",
    }
  }

// Calling the componentDidMount() method after a component is rendered for the first time.
  componentDidMount() {
    this.serverRequest = axios.get(this.props.source).then(article => {
      console.log(article);
      this.setState({
        title: article.data[0].title,
        body: article.data[0].body,
      });
    });
  }

  render() {
    return (
      < div >
        < h1 > Here is an article: < / h1 >
        < h2 > {this.state.title} < / h2 >
        < div dangerouslySetInnerHTML = {{__html: this.state.body}} > < / div >
      < / div >
    );
  }
}

export default ArticleList;
