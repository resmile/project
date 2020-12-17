import Onboarding from 'react-native-onboarding-swiper';
import React from 'react';
import { StyleSheet, Text, Button, View, Image, Alert, TextInput, TouchableOpacity, WebView } from 'react-native';
import { firebaseApp, auth, db, timeRef } from '../components/firebaseConfig.js';
import ResetPwdTxt from '../components/mem/ResetPwdTxt';


export default class LoginScreen extends React.Component {
  static navigationOptions = ({navigation, navigationOptions}) => {
    header : null
  };

  constructor(props) {
    super(props);
    this.state = {
      email : '',
      password : '',
      newRoom: true,
      newPoint: 500,
      isLoggedIn: false,
      modalVisible: false,
      
      
    }
    this.signUp = this.signUp.bind(this);
    this.login = this.login.bind(this);
  }

  _handlePressTerms = () => {
    <WebView
      source={{uri: 'http://2tai.kr/footer/terms.php'}}
      style={{marginTop: 20 }}
    />
  };

  _handlePressPolicy = () => {
    <WebView
      source={{uri: 'http://2tai.kr/footer/privacy.php'}}
      style={{marginTop: 20 }}
    />
  };

  signUp(){
    const { navigate } = this.props.navigation;
    auth.createUserWithEmailAndPassword(this.state.email, this.state.password).then(user => {
   
      db.ref('users/'+user.uid).set({
      uid : user.uid,
      age: 0,
      gender : '',
      timestamp: timeRef,
      token : "",
      email : this.state.email,
      password: this.state.password,
      point : this.state.newPoint,
      paidPoint : 0,
      isProfile : false,
      isAge : false,
      isGender : false,
      isAgreeTerms : false,
      avatar : {uri: 'https://listenchat1.firebaseapp.com/img/avatarDefault.png'}
    });
    this.addRoom(user.uid);
    this.addPoint(user.uid);
    this.addInitMsg(user.uid);
    //익명프로필 팝업창 오픈
    navigate('TermsModal')
  
  }).catch((err) => { 
    var errorCode = err.code;
    var errorMessage = err.message;

    if (errorCode === 'auth/email-already-in-use') {
      alert('이미 사용 중인 이메일이에요.');
    } else if(errorCode === 'auth/invalid-email'){
      alert('이메일 주소 형식이 아니에요, 이메일 주소를 다시 확인해주세요.');      
    } else if(errorCode === 'auth/weak-password'){
      alert('비밀번호는 6자리 이상 입력해주세요.');            
    }
    else {
    console.error(err);
    }
  });

  }

  login(){
    const { navigate } = this.props.navigation;
    auth.signInWithEmailAndPassword(this.state.email, this.state.password).then(user => {

      //user 성별, 나이 가져오기
      userRef=db.ref(`users/${uid}`);
      return userRef.once('value').then(function(snap) {
        isAgreeTerms = snap.val().isAgreeTerms;
  
        if(isAgreeTerms){
          navigate('Chat')
          
        }else{
          navigate('TermsModal')
        }
      });

  }).catch((err) => { 
    var errorCode = err.code;
    var errorMessage = err.message;

    if (errorCode === 'auth/invalid-email'){
      alert('이메일이 올바르지 않아요. 다시 확인해주세요.');      
    }
    else if (errorCode === 'auth/wrong-password') {
      alert('비밀번호가 올바르지 않아요. 다시 확인해주세요.');
    } else {
    console.error(err);
    }
  
  });
  }

  addPoint(uid) {
    this.pointsRef = db.ref(`points/${uid}`);
    if (this.state.newPoint === '') {
      return;
    }
    this.pointsRef.push({ 
      point : this.state.newPoint, 
      log : '가입 포인트 적립완료',
      timestamp: timeRef
    });
    this.setState({ newPoint: '' });
  }

  addRoom(uid) {
    this.roomsRef = db.ref(`msgs/${uid}`);
    if (this.state.newRoom === '') {
      return;
    }
    this.roomsRef.set({ state: this.state.newRoom });
    this.setState({ newRoom: '' });
  }

  addInitMsg(uid) {
    this.msgsRef = db.ref(`msgs/${uid}`);
    this.msgsRef.push(
      { 
        _id: Math.round(Math.random() * 1000000),
        text : "01 / 익명 프로필 설정\n\n반가워요 :)\n티타임을 갖기 전에 두 가지 질문을 드려요.\n\n질문1.성별 \n 남자면 m, 여자는 f 를 채팅창에 입력해주세요.",
        createdAt: Date.now(),
        user: {
          _id: "admin",
          name: '벗',
          avatar: 'https://listenchat1.firebaseapp.com/img/avatar.png',
        },
      }
    );
  }

 
  addPoint(uid) {
    this.pointsRef = db.ref(`points/${uid}`);
    if (this.state.newPoint === '') {
      return;
    }
    this.pointsRef.push({ 
      point : this.state.newPoint, 
      log : '가입 포인트 적립완료',
      timestamp: timeRef
    });
    this.setState({ newPoint: '' });
  }





  render() {
    const isLoggedIn = this.state.isLoggedIn;
    return (
      <Onboarding
        showDone={false}
        showSkip={false}
        pages={[
          {
            backgroundColor: '#fff',
            image: <Image source={require('../assets/images/icon.png')} />,
            title: '반가워요, 전 말벗이에요.',
            subtitle: '저는 들어주는 걸 좋아해요. \n 말벗이 필요할 때, 문자 채팅으로 \n 당신의 이야기를 들어드릴게요.',
          },
          {
            backgroundColor: '#fff',
            image: <Image source={require('../assets/images/onBoarding03.gif')} style={{marginBottom: 150}} />,      
            title: '이메일로 바로 시작할 수 있어요.',
            subtitle: (      
        <View>
        <TextInput
          placeholderTextClor="gray"
          placeholder="Email"
          style={styles.inputText}
          onChangeText={(email)=> this.setState({email})}
          keyboardType="email-address"
          underlineColorAndroid='transparent'
        />
        <TextInput
          placeholderTextClor="gray"
          placeholder="Password"
          style={styles.inputText}
          password={true}
          onChangeText={(password)=> this.setState({password})}
          underlineColorAndroid='transparent'
          secureTextEntry= {true}
          
        />
        
        <TouchableOpacity
          onPress={this.signUp}
          style={styles.button}
        >
            <Text
              style={styles.textButton1}
            >회원가입</Text>
        </TouchableOpacity>
        <TouchableOpacity
        onPress={this.login}
        style={styles.button}
        >
            <Text
              style={styles.textButton1}
            >로그인</Text>
        </TouchableOpacity>
        <ResetPwdTxt />
        <View style={styles.containerPolicy}>        
        <TouchableOpacity onPress={this._handlePressTerms.bind(this)}>
        <Text>이용약관</Text>
          </TouchableOpacity>
          <Text>  /  </Text>
          <TouchableOpacity onPress={this._handlePressPolicy.bind(this)}>
        <Text>개인정보취급방침</Text>
          </TouchableOpacity>
          </View>
        </View>

            )
          }
        ]}
      />
    );
  }
}
//onDone={this.renderLogin}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    marginHorizontal: 0,
    marginTop : 0
  },
  containerPolicy : {
    flexDirection: 'row',
    flex:1,
    marginHorizontal: 10,
    marginTop : 20,
    justifyContent: 'center'
  },
  inputText : {
    borderWidth: 1,
    borderColor: '#ccc',
    paddingVertical : 15,
    color : 'black',
    marginBottom : 10,
    width: 300,
    padding: 15
  },
  button : {
    paddingVertical : 15,
    borderRadius: 20,
    marginBottom : 10,
    borderWidth : 1,
    borderColor : '#ccc',
    alignItems: 'center',
    backgroundColor : '#333',
  },
  containerInputs : {
    marginBottom : 20
  },
  textButton1 : {
    color : '#fff'
  },
  modal : {
    flex: 1,
    alignItems: 'center',
    backgroundColor: '#fff',
    padding: 100,
    justifyContent: 'center'
  }
})