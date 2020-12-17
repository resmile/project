import React, { Component } from 'react';
import { StyleSheet, WebView } from 'react-native';

export default class WebViewScreen extends Component {

  static navigationOptions = ({ navigation, navigationOptions }) => {
    const { params } = navigation.state;
    return {
      headerTitle: params ? params.title : null,
    };
  };


  render() {
    const { params } = this.props.navigation.state;
    const uri = params ? params.uri : null;
    const title = params ? params.title : null;

    return (
      <WebView
        source={{uri: uri}}
      />
    );
  }
}