import React from 'react';
import { StyleSheet, Image, View } from 'react-native';
import { firebaseApp,db, auth, yy, mm, dd, h} from '../components/firebaseConfig.js';
import { NavigationActions } from 'react-navigation';

export default class SplashScreen extends React.Component {
  static navigationOptions = {
    header : null,
  };

  constructor(props) {
    super(props);
    this.state = {
      ua : '',
      ug : ''
    }        
  } 
  
  componentDidMount() {
    const { navigate } = this.props.navigation;
    auth.onAuthStateChanged(user => {

    if(user){
      var uid = user.uid;
      //user 성별, 나이 가져오기
      userRef=db.ref(`users/${uid}`);
      return userRef.once('value').then(function(snap) {
        ua = snap.val().age;
        ug = snap.val().gender;

        if(ua!='0'){

          kpiRef = db.ref(`kpi/${yy()}-${mm()}-${dd()}/${h()}/${ug}/${ua}/${uid}`);
          return kpiRef.once('value').then(function(snap) {
            if (snap.child("sessions").val() === null ) {
              //write
              kpiRef.update({
                  sessions : 1
              });
            } else {
              //update
              kpiRef.update({
                sessions : parseInt(snap.child("sessions").val()) + 1
            });
          }
          //this.props.navigation.navigate('MemoScreen', { uid : uid });
          //const navigate = this.props.navigation;
          setTimeout(() => {
            requestAnimationFrame(() => {
              navigate('Chat');
            });
          }, 2000);

          });

        }else{
          navigate('TermsModal');
        }
        
        

      });

    }else{
    navigate('Login');
    }
  });
  }

  render() {
    return (          
            <Image resizeMode="cover" style={styles.logo}
            source={require('../assets/images/splash_logo.jpg')}
            />
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    flexGrow: 1,
    backgroundColor : '#ffffff',
    justifyContent: 'center',
    top: 0,
    left: 0,
    width: '100%',
    height: '100%',
  }, logo : {
    flex: 1,
    position: 'absolute',
    width: '100%',
    height: '100%',
    justifyContent: 'center',
    top: 0,
    left: 0
  }
});
