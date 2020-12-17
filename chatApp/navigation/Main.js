import React from 'react';
import { StackNavigator } from 'react-navigation';
import SplashScreen from '../screens/SplashScreen';
import ChatScreen from '../screens/ChatScreen';
import SettingsScreen from '../screens/SettingsScreen';

export default StackNavigator(
  {
    Splash : {
      screen : SplashScreen
    },
    Chat: {
      screen: ChatScreen
    },
    Settings: {
      screen: SettingsScreen
    }
  }
);
