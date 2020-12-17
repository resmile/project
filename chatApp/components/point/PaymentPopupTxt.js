import React, { Component } from 'react';
import {
  Modal,
  Text,
  TouchableOpacity,
  View,
  StyleSheet,
  TextInput,
  ScrollView
} 
from 'react-native';
import List from './List';

export default class PaymentPopupTxt extends React.Component {
    constructor(props){
      super(props);
      this.state={
        historyModalVisible: false,
        history : []
      };
    }
    toggleModal(visible) {

        this.setState({ historyModalVisible: visible });        
   }


   render(){
     return (
      <View>
      <Modal animationType = {"slide"} transparent = {false}
         visible = {this.state.historyModalVisible}
         onRequestClose = {() => { console.log("Modal has been closed.") } }>
         <View style = {styles.modal}>
            <Text style = {styles.titleText}>구매내역</Text>            
            
            <ScrollView>
             <List />
            </ScrollView>
            <TouchableOpacity onPress = {() => {
               this.toggleModal(!this.state.historyModalVisible, 'history')}}>
               <Text style = {styles.closePopup}>팝업닫기</Text>
            </TouchableOpacity>
         </View>
      </Modal>
      <View style={styles.container}>
        <View>
        <TouchableOpacity onPress = {() => {this.toggleModal(true, 'history')}}>
         <Text style = {styles.text}>구매 내역 보기</Text>
      </TouchableOpacity>
        </View>
      </View>
   </View>
     )
   }
    
  }

  const styles = StyleSheet.create ({
    container: {
      flex: 1,
      flexDirection: 'row'
    },
    modal: {
      flex: 1,
      alignItems: 'center',
      backgroundColor: '#eee',
      paddingVertical: 100,
      paddingBottom : 100
   },
    text: {
      fontSize: 14,
      marginTop: 6,
      alignItems: 'center',      
      color: '#fff',
      backgroundColor : '#999',
      padding: 5
    },
    titleText:{
      fontSize: 24,
      marginBottom : 30,
      textAlign: 'center'
    },
    closePopup : {
      fontSize: 14,
      marginTop: 6,     
      color: '#ccc',
      textDecorationLine : 'underline',
      padding: 5,
      textAlign: 'center'
    }
 })