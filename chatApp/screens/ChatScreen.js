import React, {Component} from 'react';
import {
  Platform,
  StyleSheet,
  Text,
  View,
  Button,
  TouchableOpacity
} from 'react-native';
import { firebaseApp, auth ,db, timeRef, yy, mm, dd, h, m, s } from '../components/firebaseConfig.js';
import GetPointTxt from '../components/point/GetPointTxt';
import ProfileImg from '../components/header/ProfileImg';
import {GiftedChat, Bubble, SystemMessage} from 'react-native-gifted-chat';



export default class ChatScreen extends React.Component {
  static navigationOptions = ({navigation, navigationOptions}) => {

    return { 
    headerTitle: <ProfileImg />,
    headerLeft: (
      <TouchableOpacity onPress={() => navigation.navigate('Point')}>
       <GetPointTxt style={styles.pointText} />
    </TouchableOpacity>

    ),
    headerRight: (
      <Button
      onPress={() => navigation.navigate('Settings')}
        title="도움말"
      />
    ),
   };
  };

  constructor(props) {
    super(props);
    this.state = {
      messages: [],
      loadEarlier: true,
      typingText: null,
      isLoadingEarlier: false,
      user: '',
      point: '',
      state : '',
      curTime : '',
      curHour : '',
      curMin : '',
      opening_time_h : '',
      opening_time_m : '',
      closeing_time_h : '',
      closeing_time_m : '',
      isProfile : '',
      isAge : '',
      isGender : ''
    };

    var user = auth.currentUser;
    var uid = user.uid;
    this.msgsRef = db.ref(`msgs/${uid}`);

    this._isMounted = false;
    this.addMsg = this.addMsg.bind(this);
    this.onReceive = this.onReceive.bind(this);
    this.renderBubble = this.renderBubble.bind(this);
    this.renderSystemMessage = this.renderSystemMessage.bind(this);
    this.renderFooter = this.renderFooter.bind(this);
    this.onLoadEarlier = this.onLoadEarlier.bind(this);
    this._isAlright = null;
  }  


  componentWillMount() {
    this._isMounted = true;
    /*
    this.setState(() => {
      return {
        messages: require('../data/messages.js'),
      };
    });
    */
  }


  componentWillUnmount() {
    this._isMounted = false;
  }

  componentDidMount() {
    var user = auth.currentUser;
    var roomId = user.uid;
    //오늘날짜 구하기
    var date = new Date(),
        year = date.getFullYear(),
        month = date.getMonth()+1,
        day = date.getDate(),
        hour = date.getHours(),
        minute = date.getMinutes();

    if(month < 10){
      month = "0"+month;
    }

    //영업시간 데이터베이스 참조 가져오기
    var opening_time_h_Ref = db.ref(`biz/${year}-${month}-${day}/opening_time_h`);    
    var opening_time_m_Ref = db.ref(`biz/${year}-${month}-${day}/opening_time_m`);
    var closeing_time_h_Ref = db.ref(`biz/${year}-${month}-${day}/closeing_time_h`);    
    var closeing_time_m_Ref = db.ref(`biz/${year}-${month}-${day}/closeing_time_m`);

    //클라이언트 단말기의 현재 시간 가져오기
    setInterval(function(){
        this.setState({
            curTime: date.toLocaleString(),
            curHour: date.getHours(),
            curMin: date.getMinutes()
        })
    }.bind(this), 1000);


    this.setState({ user: auth.currentUser });
    this.getMsgs(this.msgsRef);
    this.props.navigation.setParams({
      handleSave: () => this.pointDetails()
    });

    var user = auth.currentUser;
    var uid = user.uid;
    var pointRef = db.ref(`users/${uid}/point`);
    var stateRef = db.ref(`msgs/${uid}/state`);
    var isProfileRef = db.ref(`users/${uid}/isProfile`);
    var isAgeRef = db.ref(`users/${uid}/isAge`);
    var isGenderRef = db.ref(`users/${uid}/isGender`);

    isProfileRef.on('value', snap => {
      this.setState({ isProfile : snap.val() });
    });

    isAgeRef.on('value', snap => {
      this.setState({ isAge : snap.val() });
    });
    
    isGenderRef.on('value', snap => {
      this.setState({ isGender : snap.val() });
    });

    pointRef.on('value', snap => {
      this.setState({ point: snap.val().toFixed(1) });
    });
    
    stateRef.on('value', snap => {
      this.setState({ state: snap.val() });
    });

    opening_time_h_Ref.on('value', snap => {
      this.setState({ opening_time_h : snap.val() });
    });
    opening_time_m_Ref.on('value', snap => {
      this.setState({ opening_time_m : snap.val() });
    });
    closeing_time_h_Ref.on('value', snap => {
      this.setState({ closeing_time_h : snap.val() });
    });
    closeing_time_m_Ref.on('value', snap => {
      this.setState({ closeing_time_m : snap.val() });
    });

  }

  onLoadEarlier() {
    this.setState((previousState) => {
      return {
        isLoadingEarlier: true,
      };
    });

    setTimeout(() => {
      if (this._isMounted === true) {
        this.setState((previousState) => {
          return {
            messages: GiftedChat.prepend(previousState.messages, require('../data/old_messages.js')),
            loadEarlier: false,
            isLoadingEarlier: false,
          };
        });
      }
    }, 1000); // simulating network
  }

  getMsgs(msgsRef) {
    msgsRef.on('value', (dataSnapshot) => {
      var msgsFB = [];
      dataSnapshot.forEach((child) => {
        if(child.key !="timestamp"){
          if(child.key !="state"){
          msgsFB = [({
          _id: child.key,
          text: child.val().text,
          createdAt: child.val().createdAt,
          user: {
            _id: child.val().user._id,
            name: child.val().user.name
          }
        }), ...msgsFB];
        }
      }

      });
      this.setState({ messages: msgsFB });
    });
  }

  addMsg(messages = {}) {

    var msg = messages[0]
    this.msgsRef.push({
      text: msg.text,
      createdAt: Date.now(),
      user: {
        _id: msg.user._id,
        name: msg.user.name
      }
    })
    var user = auth.currentUser;
    var uid = user.uid;

    if(this.state.state){
      //true = 답장을 보낸 채팅방이기 때문에
      var updates = {}
      updates['/state'] = false;
      updates['/timestamp'] = timeRef;
      db.ref(`msgs/${uid}`).update(updates);
      this.setState({state:false});    
    }

    this.addMsgsKpi(uid); //톡전송수
    this.contentsMsgsKpi(uid, msg); //메세지 내용

    /*
    this.setState((previousState) => {
      return {
        messages: GiftedChat.append(previousState.messages, messages),
      };
    });*/

    // for demo purpose
    if(this.state.isProfile === false){
      this.answerDemo(messages);
    }
  }

  addMsgsKpi(uid) {
    //addMsgs KPI Start (고민등록수)
    //user 성별, 나이 가져오기
    userRef=db.ref(`users/${uid}`);
    return userRef.once('value').then(function(snap) {
      ua = snap.val().age;
      ug = snap.val().gender;
  
      kpiRef = db.ref(`kpi/${yy()}-${mm()}-${dd()}/${h()}/${ug}/${ua}/${uid}`);
      return kpiRef.once('value').then(function(snap) {
        if (snap.child("addMsgs").val() === null ) {
          //write
          kpiRef.update({
            addMsgs : 1
          });
        } else {
          //update
          kpiRef.update({
            addMsgs : parseInt(snap.child("addMsgs").val()) + 1
        });
      }
      
      });
    
    });
    //addMsgs KPI End
    }

    
    
    contentsMsgsKpi(uid, msg) {

      //contentsWorrys KPI Start (고민내용)
      //user 성별, 나이 가져오기
      userRef=db.ref(`users/${uid}`);
      return userRef.once('value').then(function(snap) {
        ua = snap.val().age;
        ug = snap.val().gender;
    
        kpiRef = db.ref(`kpi/${yy()}-${mm()}-${dd()}/${h()}/${ug}/${ua}/${uid}`);
        return kpiRef.once('value').then(function(snap) {
          if (snap.child("contentsMsgs").val() === null ) {
            kpiRef.update({
              contentsMsgs : []
            });
            
          }

            kpiRef2 = db.ref(`kpi/${yy()}-${mm()}-${dd()}/${h()}/${ug}/${ua}/${uid}/contentsMsgs/user`);          
            kpiRef2.push({
              sender : msg.user._id,
              lengthOfMsg : msg.text.length,
              contentsOfMsg : msg.text,
              timeOfMsg : `${h()}:${m()}:${s()}`
            });        
        });
      
      });
      //contentsMsgs KPI End
      }



  answerDemo(messages) {
    if (messages.length > 0) {
      if ((messages[0].image || messages[0].location) || !this._isAlright) {
        this.setState((previousState) => {
          return {
            typingText: '입력중입니다..'
          };
        });
      }
    }

    setTimeout(() => {
      if (this._isMounted === true) {
        if(this.state.isProfile === false && messages.length > 0 ){
          //질문1
          if(this.state.isGender === false){
            if (messages[0].text =="m" || messages[0].text =="f") {
              this.isProfileSetting('isGender', messages[0].text);
              this.onReceive('질문2.나이를 숫자로 입력해주세요. (예: 30)');
            }else{
              this.onReceive('다시 질문드려요 :)\n\n질문1.성별 \n남자면 m, 여자는 f 를 채팅창에 입력해주세요.');
            }
          }else if(this.state.isAge === false){
            if (messages[0].text > 9 && messages[0].text < 99) {
              this.onReceive('고마워요, 잘 답변해줘서요 :)\n이제 우리 티타임 가져요 :)');
              this.isProfileSetting('isAge');
            }else{
              this.onReceive('다시 질문드려요 :)\n\n질문2.나이를 숫자로 입력해주세요. (예: 30)');
            }
          }
        }
      }

      this.setState((previousState) => {
        return {
          typingText: null,
        };
      });
    }, 1000);
  }

  isProfileSetting(state, gender) {
    //isGender 인 경우 스테이트 true로 변경, 프로필 아이콘 변경
    //isAge 인 경우 스테이트 isAge와 isProfile true로 변경
    const that=this;
    var user = auth.currentUser;
    var uid = user.uid;
    userRef = db.ref(`users/${uid}`);
    return userRef.once('value').then(function(snap) {
      if (state == 'isGender' ) {
        var avatar='';
        if(gender=='m'){
          avatar = {uri: 'https://listenchat1.firebaseapp.com/img/avatarMen.png'}
        }else{
          avatar = {uri: 'https://listenchat1.firebaseapp.com/img/avatarWomen.png'}
        }
        userRef.update({
          isGender : true,
          avatar : avatar
        });
        that.setState({ 
          isGender: true
        });

      }
      if (state == 'isAge' ) {
        userRef.update({
          isAge : true,
          isProfile : true
        });
        that.setState({ 
          isAge : true,
          isProfile: true
        });
        
    }
  });

  }
  onReceive(text) {
    var user = auth.currentUser;
    var uid = user.uid;
    this.msgsRef = db.ref(`msgs/${uid}`);
    this.msgsRef.push(
      { 
        _id: Math.round(Math.random() * 1000000),
        text : text,
        createdAt: Date.now(),
        user: {
          _id: "admin",
          name: '벗',
          avatar: {uri: 'https://listenchat1.firebaseapp.com/img/avatarMen.png'},
        },
      }
    );
    /*
    this.setState((previousState) => {
      return {
        messages: GiftedChat.append(previousState.messages, {
          _id: Math.round(Math.random() * 1000000),
          text: text,
          createdAt: new Date(),
          user: {
            _id: "admin",
            name: '벗',
            avatar: 'https://listenchat1.firebaseapp.com/img/avatar.png',
          },
        }),
      };
    });
    */
  }



  renderBubble(props) {
    return (
      <Bubble
        {...props}
        wrapperStyle={{
          left: {
            backgroundColor: '#f0f0f0',
          }
        }}
      />
    );
  }

  renderSystemMessage(props) {
    return (
      <SystemMessage
        {...props}
        containerStyle={{
          marginBottom: 15,
        }}
        textStyle={{
          fontSize: 14,
        }}
      />
    );
  }



  renderFooter(props) {
    if (this.state.typingText) {
      return (
        <View style={styles.footerContainer}>
          <Text style={styles.footerText}>
            {this.state.typingText}
          </Text>
        </View>
      );
    }
    return null;
  }

  render() {
    const point = this.state.point;
    const curTime = this.state.curTime;
    const ch = h();
    const { opening_time_h, opening_time_m, closeing_time_h , closeing_time_m , curHour, curMin } = this.state
    
    return (
      <GiftedChat
        messages={this.state.messages}
        onSend={this.addMsg}
        loadEarlier={this.state.loadEarlier}
        onLoadEarlier={this.onLoadEarlier}
        isLoadingEarlier={this.state.isLoadingEarlier}

        user={{
          _id: this.state.user.uid,
          name: this.state.user.email,
        }}

        renderBubble={this.renderBubble}
        renderSystemMessage={this.renderSystemMessage}
        renderFooter={this.renderFooter}
      />
      
      
    );
  }
}

const styles = StyleSheet.create({
  footerContainer: {
    marginTop: 5,
    marginLeft: 10,
    marginRight: 10,
    marginBottom: 10,
  },
  footerText: {
    fontSize: 14,
    color: '#aaa',
  },
});