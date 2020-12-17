import React from 'react';
import { StackNavigator } from 'react-navigation';
import Main from './navigation/Main';
import TermsModal from './screens/TermsModal';
import WebViewModal from './screens/WebViewModal';
import LoginModal from './screens/LoginModal';

const RootStackNavigator = StackNavigator(
  {
    Main: { screen: Main },
    TermsModal : { screen: TermsModal },
    WebViewModal : { screen: WebViewModal },
    LoginModal : { screen: LoginModal}
  },
  {
    mode: 'modal',
    headerMode: 'none',
    initialRouteName: 'Main'
  },
);


export default class App extends React.Component {

  render() {
    return <RootStackNavigator />;
  }
}
