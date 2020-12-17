import React, { Component } from 'react';
import {
  Dimensions,
  Platform,
  Modal,
  Text,
  TouchableOpacity,
  View,
  StyleSheet,
  TextInput,
  Alert,
  TouchableWithoutFeedback, 
  Keyboard
} 
from 'react-native'
import { auth ,db } from '../firebaseConfig.js';

const {height, width} = Dimensions.get('window'); 
const aspectRatio = height/width;

export default class ResetPwdTxt extends React.Component {
    constructor(props){
      super(props);
      this.state={
        modalVisible: false,
        email : ''
      };
      this.resetPassword = this.resetPassword.bind(this);
    }
    toggleModal(visible, type) {
        this.setState({ modalVisible: visible });
   }

  resetPassword = () => {
    Alert.alert(
      '비밀번호 초기화',
      '비밀번호 재설정을 위한 이메일이 발송됩니다.\n로그인은 비밀번호 변경 이후에 이용하실 수 있어요.',
      [
        {text: 'Cancel', onPress: () => console.log('Cancel Pressed'), style: 'cancel'},
        {text: 'OK', onPress: () => {
          var email = this.state.email;
    auth.languageCode = 'ko';
    auth.sendPasswordResetEmail(email).then(function() {
      alert('이메일이 정상적으로 발송되었습니다. \n 발송된 메일에서 비밀번호를 재설정해주세요.');
      
    }).catch(function(error) {
      alert('이메일이 존재하지 않습니다.'+error);
    });
      }},
      ],
      { cancelable: false }
    )


    
  };

   render(){
     return (
      
      <View>
      <Modal animationType = {"slide"} transparent = {false}
         visible = {this.state.modalVisible}
         onRequestClose = {() => { console.log("Modal has been closed.") } }>
        <TouchableWithoutFeedback onPress={() => {Keyboard.dismiss()}}>
         <View style = {styles.modal}>
         <Text style = {styles.titleText} >비밀번호를 잊어버리셨나요?</Text>         
         <Text style = {styles.subText}>기존에 가입한 이메일을 입력하시면{"\n"}발송된 메일을 통해 비밀번호를 변경할 수 있어요.</Text>
            <TextInput
              placeholderTextClor="gray"
              placeholder="Email"
              style={styles.inputText}
              keyboardType="email-address"
              onChangeText={(email)=> this.setState({email})}
              underlineColorAndroid='transparent'          
            />


            <TouchableOpacity 
              onPress={this.resetPassword.bind(this)}
              style={styles.button}
            >   
               <Text style = {styles.textButton1}>비밀번호 초기화</Text>
            </TouchableOpacity>

            <TouchableOpacity onPress = {() => {
               this.toggleModal(!this.state.modalVisible)}}>
               
               <Text style = {styles.text1}>팝업닫기</Text>
            </TouchableOpacity>
         </View>
         </TouchableWithoutFeedback>
      </Modal>
      <View style={styles.container}>
        <View style={styles.textContainer}>
        <TouchableOpacity onPress = {() => {this.toggleModal(true)}}>
         <Text style = {styles.text1}>비밀번호를 잊어버리셨나요?</Text>
      </TouchableOpacity>
        </View>
      </View>
   </View>

     )
   }
    
  }

  const styles = StyleSheet.create ({
    container: {
      //flex: 1,
      //flexDirection: 'row'
    },
    modal: {
       flex: 1,
       alignItems: 'center',
       backgroundColor: '#fff',
       marginTop: (Platform.OS === 'android' || (Platform.OS === 'ios' && aspectRatio<1.6) ) ? 50 : 100
    },
    text1: {
      fontSize: (Platform.OS === 'android' || (Platform.OS === 'ios' && aspectRatio<1.6) ) ? 10 : 14,      
      marginTop: 6,     
      color: '#ccc',
      textDecorationLine : 'underline',
      padding: 5
    },
    titleText:{
      fontSize: (Platform.OS === 'android' || (Platform.OS === 'ios' && aspectRatio<1.6) ) ? 20 : 24,
      marginBottom : 30,
      color: '#333',
    },
    subText:{ 
      fontSize: (Platform.OS === 'android' || (Platform.OS === 'ios' && aspectRatio<1.6) ) ? 13 : 17,
      marginBottom : 50,
      color: '#999',
      textAlign: 'center'
    },
    text2: {
      fontSize: 14,
      marginTop: 6,
      color: '#fff',
      backgroundColor : '#999',
      padding: 5
    },
    textContainer : {
      alignItems: 'center'
    },
    inputText : {
      borderWidth: 1,
    borderColor: '#ccc',
    paddingVertical : (Platform.OS === 'android' || (Platform.OS === 'ios' && aspectRatio<1.6) ) ? 12 : 15,
    color : 'black',
    marginBottom : 10,
    width: 300,
    padding: 15,
    ...Platform.select({
      android: {
          fontSize: 12
      },
    })
    },
    containerInputs : {
      marginBottom : 20
    },
    button : {
      paddingVertical : 15,
      borderRadius: 20,
      marginBottom : 10,
      borderWidth : 0,
      borderColor : '#37ab6d',
      alignItems: 'center',
      backgroundColor : '#80ddaa',
      width: 300,
    },
    textButton1 : {
      color : '#fff',
      ...Platform.select({
        android: {
            fontSize: 11
        },
      })
    },
 })