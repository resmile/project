import React, { Component } from 'react';
import IAmPort from 'react-native-iamport';
import { firebaseApp,db, auth, yy, mm, dd, h, timeRef} from '../components/firebaseConfig.js';
import { Button } from 'react-native';
export default class PaymentScreen extends Component {

  static navigationOptions = ({ navigation, navigationOptions }) => {
    const { params } = navigation.state;
    return {
      headerTitle: '결제',
      headerRight: (
        <Button
        onPress={() => navigation.navigate('Chat')}
          title="닫기"
        />
      ),
    };
  };
  constructor(props){
    super(props);
    this.state={
      email : '',
      uid : ''
    }

  }

  componentDidMount() {
    var user = auth.currentUser;
    var uid = user.uid;
    var emailRef = db.ref(`users/${uid}/email`);
    emailRef.on('value', snap => {
      this.setState({ 
        email: snap.val()
      });
    });
  }

  //내담자 정보에 포인트 값 읽어오고 그 값에 추가 포인트만큼 업데이트
  updatePaidPoint = (uid, point) => {
    var uid = uid;
    var point = point;
    //user 포인트 가져오기
    userRef=db.ref(`users/${uid}`);
    return userRef.once('value').then(function(snap) {
      paidPoint = snap.val().paidPoint;
      ua = snap.val().age;
      ug = snap.val().gender;

      return userRef.once('value').then(function(snap) {
          //결제 포인트 update
          userRef.update({
            paidPoint : parseInt(snap.child("paidPoint").val()) + point
        });
      });
    });
  }

  //내담자 payments에 push
  addPayments = (uid, name, point, price) => {
    var uid = uid;
    var name = name;
    var point = point;
    var price = price;

    //구매내역 추가
    var paidRef = db.ref(`payments/${uid}`);
    var chargedPoint = ({
        chargedPointAmount : parseFloat(point),
        payments : parseInt(1),
        paidAmount : parseInt(price)
    });

    var newPay = {
      name : name,
      price : parseInt(price),
      point : parseFloat(point),
      checked : true,
      state : '결제완료',
      timestamp : timeRef,
      text : name+' ('+parseInt(price)+'원 결제완료)'
    };
    paidRef.push(newPay);
   
  };

  //chargedPointKpi (포인트 충전내역)
  chargedPointKpi = (uid, name, point, price) => {
    var uid = uid;
    var name = name;
    var point = point;
    var price = price;

    //user 포인트 가져오기
    userRef=db.ref(`users/${uid}`);
    return userRef.once('value').then(function(snap) {
      paidPoint = snap.val().paidPoint;
      ua = snap.val().age;
      ug = snap.val().gender;

      if(ua!='0'){
        var kpiRef = db.ref(`kpi/${yy()}-${mm()}-${dd()}/${h()}/${ug}/${ua}/${uid}/charged`);
            var chargedPoint = ({
                chargedPointAmount : parseFloat(point),
                payments : parseInt(1),
                paidAmount : parseInt(price)
            });
            kpiRef.push(chargedPoint);
      }

    });
   
  };

  handlePaymentSuccess = (response) => {
    if (response.result == "success") {
      //결제금액과 상품명 참조값 가져오기
      const { params } = this.props.navigation.state;
      const name = params ? params.name : null;
      const point = params ? params.point : null;
      const price = params ? params.price : null;
      
      //user 가져오기
      var user = auth.currentUser;
      var uid = user.uid;
      this.updatePaidPoint(uid, point);
      this.addPayments(uid, name, point, price);
      this.chargedPointKpi(uid, name, point, price);
    
    } else {
      console.log("결제가 완료되지 않았어요.");
    }

    
}


  render() {
    const { params } = this.props.navigation.state;
    const name = params ? params.name : null;
    const price = params ? params.price : null;
    const email = this.state.email;
    return (
      <IAmPort onPaymentResultReceive={this.handlePaymentSuccess} params={{
        code: "imp84406206",
        pg: "nice",
        pay_method: "card",
        app_scheme: "teatime",
        name: name,
        amount: price,
        buyer_email: email,
        buyer_name: "",
        buyer_tel: "",
        buyer_addr: "",
        buyer_postcode: ""
      }}></IAmPort>

    );
  }
}