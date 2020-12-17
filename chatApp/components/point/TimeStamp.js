import React from 'react';
import { View } from 'react-native';
import styles from './styles';
import { Timestamp } from 'react-timestamp';

export default class TimeStamp extends React.Component {
  

  render() {
    const { payment } = this.props;


    return (
      <View>
          <Timestamp time={payment.timestamp} format='date'/>
      </View>
    );
  }
}