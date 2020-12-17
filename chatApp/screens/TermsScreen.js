import React, { Component } from 'react';
import { BackHandler, View, TouchableOpacity, Text, StyleSheet } from 'react-native';
import { firebaseApp, auth, db, timeRef } from '../components/firebaseConfig.js';
import CheckBox from 'react-native-checkbox';

export default class TermsScreen extends Component {
  static navigationOptions = ({navigation, navigationOptions}) => {
    header:false
  };

  constructor(props){
    super(props);
    this.state={
      terms : false,
      privacy : false,
    };
  }

  componentDidMount() {
    BackHandler.addEventListener('backPress');
  }
  
  componentWillUnmount() {
    BackHandler.removeEventListener('backPress');
  }

  _handlePressTerms = () => {
    this.props.navigation.navigate('WebView', {
      uri: 'http://2tai.kr/footer/terms.php',
      title: '이용약관',
    });
  };

  _handlePressPolicy = () => {
    this.props.navigation.navigate('WebView', {
      uri: 'http://2tai.kr/footer/privacy.php',
      title: '개인정보취급방침',
    });
  };


  termsCheck() {
    const { navigate } = this.props.navigation;
    if(!this.state.terms){
      alert("이용약관에 동의해주세요.");
    }else{
      if(!this.state.privacy){
        alert("개인정보취급방침에 동의해주세요.");
      }else{
        navigate('Chat')
      }
    }
    //var gender = this.state.gender;
    //var age = this.state.age;
    /*
    var user = auth.currentUser;
    var roomId = user.uid;
    var updates = {}
    updates['/gender'] = gender;
    updates['/age'] = age;    
    db.ref('users').child(roomId).update(updates);

    if(age!=0){
      navigation.navigate('Chat')
    }
    */
    
    
  }

  render() {
    return (
      <View style={styles.container}>

      <Text style = {styles.titleText}>약관 동의,</Text>
      <Text style = {styles.subText}>저는 들어주는 걸 좋아해요.{"\n"} 말벗이 필요할 때, 당신의 이야기를 들어드릴게요.</Text>
      <View style={styles.containerPolicy}>        
        <TouchableOpacity onPress={this._handlePressTerms.bind(this)}>
        <Text>이용약관</Text>
          </TouchableOpacity>
          <Text>  /  </Text>
          <TouchableOpacity onPress={this._handlePressPolicy.bind(this)}>
        <Text>개인정보취급방침</Text>
          </TouchableOpacity>
          </View>

      <CheckBox
        label='이용약관에 동의함'
        checked={this.state.terms}
        onChange={(checked) => {
          if(this.state.terms){
            this.setState({
              terms : false
            });
          }else{
            this.setState({
              terms : true
            });
          }
          
        }
      }
      />
      <CheckBox
        label='개인정보취급방침에 동의함'
        checked={this.state.privacy}
        onChange={(checked) => {
          if(this.state.privacy){
            this.setState({
              privacy : false
            });
          }else{
            this.setState({
              privacy : true
            });
          }
          
        }
      }
      />
        <TouchableOpacity
        onPress={this.termsCheck.bind(this)}
        style={styles.button}
        >
            <Text
              style={styles.textButton}
            >시작하기</Text>
        </TouchableOpacity>    
        </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    paddingVertical : 100
  },
  textButton : {
    color : '#fff'
  },
  button : {
    marginTop:20,
    paddingVertical : 15,
    borderRadius: 20,
    marginBottom : 10,
    borderWidth : 1,
    borderColor : '#ccc',
    alignItems: 'center',
    backgroundColor : '#333',
    width: 300,
  },
  titleText:{
    fontSize: 24,
    marginBottom : 30,
  },
  subText:{ 
    fontSize: 17,
    marginBottom : 20,
    color: '#333',
    textAlign: 'center'
  },
  containerPolicy : {
    flexDirection: 'row',
    flex:1,
    marginHorizontal: 10,
    marginTop : 20,
    justifyContent: 'center'
  },
});