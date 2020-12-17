import React from 'react';
import { FlatList, View, Text } from 'react-native';
import orderBy from 'lodash/orderBy';
import ListItem from './ListItem';
import styles from './styles';
import { auth ,db } from '../firebaseConfig.js';

export default class List extends React.Component {
  
  state = {
    payments: [],
    paymentsLoading: true
  };

  componentDidMount() {
    this.getpayments();
  }

  getpayments(){
    var user = auth.currentUser;
    var uid = user.uid;
    var paymentsRef = db.ref(`payments/${uid}`).orderByChild('timestamp');
    
    paymentsRef.on('value', snap => {
      var payments = [];
      snap.forEach(shot => {
        payments.push({ ...shot.val(), key: shot.key });
      });
      payments = payments.reverse();
      this.setState({ payments, paymentsLoading: false });
    });
  }

  renderItem = ({ item }) => {
  return <ListItem payment={item} />;
  };

  render() {
    const { payments, paymentsLoading } = this.state;
    const orderedpayments = orderBy(
      payments,
      'asc'
    );

    let List;
    if (paymentsLoading) {
      List = (
        <View style={styles.List_Empty}>
          <Text style={styles.List_EmptyText}>Loading...</Text>
        </View>
      );
    } else if (payments.length) {
      List = (
      <FlatList 
        data={orderedpayments} 
        renderItem={this.renderItem} 
        style={styles.List_FlatList}
        />
    );
    } else {
      List = (
        <View style={styles.List_Empty}>
          <Text style={styles.List_EmptyText}>구매내역이 없어요.</Text>
        </View>
      );
    }

    return List;
  }
}