import React from 'react';
import { View, Text } from 'react-native';
import styles from './styles';
import { auth ,db } from '../firebaseConfig.js';
//import {Timestamp} from 'react-timestamp';
//<Timestamp time={payment.timestamp} component={Text} />
export default class ListItem extends React.Component {
  

  render() {
    const { payment } = this.props;
    var date = new Date(payment.timestamp),
      yy = date.getFullYear(),
      mm = date.getMonth()+1,
      dd = date.getDate(),
      h = date.getHours(),
      m = date.getMinutes();
    var payment_date = yy+"-"+mm+"-"+dd+" "+h+":"+m;

    return (
      <View style={styles.ListItem}>
          <Text style={styles.ListItem_Text}>
            {payment.text}    <Text style={{ fontSize:12, color:'#ccc' }}>{payment_date}</Text>
            </Text>
            
      </View>
    );
  }
}