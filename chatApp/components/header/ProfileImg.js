import React, {Component} from 'react';
import { View, Image } from 'react-native';
import { auth ,db } from '../firebaseConfig.js';


export default class ProfileImg extends React.Component {
    constructor(props){
      super(props);
      this.state={
        avatar : {uri: 'https://xxx.firebaseapp.com/img/avatarDefault.png'}
      }
    }
    
    componentDidMount() {
      var user = auth.currentUser;
      var uid = user.uid;
      var avatarRef = db.ref(`users/${uid}/avatar`);
   
      avatarRef.on('value', snap => {
        this.setState({ 
          avatar: snap.val()
        });
      });
      
    }
  
    render() {
      var avatar = this.state.avatar;
      return (
        
        <Image
        source={this.state.avatar}
        style={{ 
          width: 30, 
          height : 30,
        }}
        />
    );
    }
  }

