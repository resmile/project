import React, { Component } from 'react';
import { StyleSheet, WebView, Text, TouchableOpacity, View } from 'react-native';

export default class WebViewModal extends Component {

  static navigationOptions = ({ navigation, navigationOptions }) => {
    return {
      headerTitle: false
    };
  };
  render() {
    const { params } = this.props.navigation.state;
    const uri = params ? params.uri : null;
    const title = params ? params.title : null;
    return (

      <View style={styles.modal}>
      <Text style = {styles.titleText}>{title}</Text> 
      <WebView
        source={{uri: uri}}
        style={{height: 200, width: 380, marginBottom : 30}}
      />
      <TouchableOpacity
              onPress={() => this.props.navigation.goBack()}>
               <Text style = {styles.closePopup}>팝업닫기</Text>
            </TouchableOpacity>
    </View>
    );
  }
}

const styles = StyleSheet.create ({
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