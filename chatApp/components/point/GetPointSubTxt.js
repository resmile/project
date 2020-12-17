import React, {Component} from 'react';
import { Text } from 'react-native';
import { auth ,db } from '../firebaseConfig.js';


export default class GetPointSubTxt extends React.Component {
    constructor(props){
      super(props);
      this.state={
        point: '',
        paidPoint:'',
        isMounted: null
      }
  
    }

    componentWillMount(){
      this.setState({
        isMounted: true
      })
    }
    componentWillUnmount() {
      this.setState({ 
        isMounted: false
      });
    }

    componentDidMount() {
        if(this.state.isMounted){
          
        var user = auth.currentUser;
        var roomId = user.uid;
        var pointRef = db.ref(`users/${roomId}/point`);
        var paidPointRef = db.ref(`users/${roomId}/paidPoint`);      
        
        pointRef.on('value', snap => {
          this.setState({ 
            point: snap.val().toFixed(1)
          });
        });
        paidPointRef.on('value', snap => {
          this.setState({ 
            paidPoint : snap.val().toFixed(1)
          });
        });
      }
      
    }
  
    render() {
      return (
        <Text>  무료 혜택 : {this.state.point} mL / 유료 구매 : {this.state.paidPoint} mL</Text>
      );
    }
  }

