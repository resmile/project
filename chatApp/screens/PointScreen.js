import React from 'react';
import { Alert,SectionList, Image, StyleSheet, Text, View, Button, TouchableOpacity } from 'react-native';
import {RadioGroup, RadioButton} from 'react-native-flexi-radio-button'
import { auth, db } from '../components/firebaseConfig.js';
import GetPointTxt from '../components/point/GetPointTxt';
import GetPointSubTxt from '../components/point/GetPointSubTxt';
import PaymentPopupTxt from '../components/point/PaymentPopupTxt';


export default class PointScreen11 extends React.Component {
  static navigationOptions = ({navigation, navigationOptions}) => {
    const params = navigation.state.params || {};
    return { 
    headerTitle: '차 한잔 더 할까요?'
   };
  };

  constructor(props) {
    super(props);
    this.state = {
      name : null,
      price : null,
      point : null,
    }
    var user = auth.currentUser;
    var roomId = user.uid;
  }

  onSelect(index, value){
    var name=null;
    switch (index) {
      case 0 :
        name='차한잔(300mL)';
        point=300;
        break;
      case 1:
        name='차한잔(500mL)';
        point=500;
        break;
      case 2:
        name='차한잔(1L)';
        point=1000;
        break;

      case 3:
        name='차한잔(2.5L)';
        point=2500;
    }

    this.setState({
      name : name,
      price: value,
      point : point
    })
  }

  render() {
    const sections = [
      {
        data: [
          { 
            value: '리터(mL) 구매',
          }
        ],
        title: '리터(mL) 구매',
      },
    ]; 

    return (
      <SectionList
        style={styles.container}
        renderItem={this._renderItem}
        renderSectionHeader={this._renderSectionHeader}
        stickySectionHeadersEnabled={true}
        keyExtractor={(item, index) => index}
        ListHeaderComponent={ListHeader}
        sections={sections}
      />
    );
  }


  _renderSectionHeader = ({ section }) => {
    return <SectionHeader title={section.title} />;
  };

  _renderItem = ({ item }) => {
 
      return (
        <SectionContent>
          <Text style = {styles.subText}>
          티타임에서는 <Text style={{fontWeight:'bold', color:'#333'}}>매월 1일, 차 한잔(500 ml)을 무료 제공</Text>하고 있어요.{"\n"}</Text>
          <Text style = {styles.subText2}>말벗과 더 많은 대화를 원하신다면</Text>
          <Text style = {styles.subText2}>아래 사이즈를 선택하고 결제해주세요.</Text>

          <RadioGroup
            onSelect = {(index, value) => this.onSelect(index, value)}
          >
            <RadioButton 
              value={5900} 
              color='black'
            >
              <Text>300mL <Text>(5,900원)</Text></Text>
              <Text style = {styles.subText}>약 30분간 대화할 수 있는 양<Text>300mL (5,900원)</Text></Text>                
            </RadioButton>

            <RadioButton 
              value={9900}
              color='black'
            >
              <Text style = {styles.subText2}>500mL, <Text style = {styles.subText}>약 1시간 동안 대화할 수 있는 양</Text></Text>
              <Text>9,900원</Text>                                                
            </RadioButton>

            <RadioButton 
              value={16900}
              color='black'
            >
              <Text>1L (16,800원) : 3,200원 할인</Text>
            </RadioButton>
            <RadioButton 
              value={39500}
              color='black'
            >
              <Text>2.5L (39,500원) : 10,500원 할인</Text>
            </RadioButton>
          </RadioGroup>
          
          <Text style = {styles.priceTitle}>결제예정금액 : <Text style={styles.price}>{this.state.price} 원</Text></Text>
          <TouchableOpacity 
          onPress={() => {
            this.props.navigation.navigate('Payment', {
              price : this.state.price,
              name : this.state.name,
              point : this.state.point
            });
          }}
          style={styles.button}>   
             <Text style = {styles.textButton}>결제하기</Text>
          </TouchableOpacity>
        </SectionContent>
      );
    
  };
}

const ListHeader = ( ) => {
  var email = auth.currentUser.email;
  return (
    <View>
      <View style={styles.titleTextContainer1}>
        <Text style={styles.emailText}>
           {email}
        </Text>
      </View>
    <View style={styles.titleContainer2}>

      <View style={styles.titleTextContainer}>
        <Text style={styles.nameText} numberOfLines={1}>
          <GetPointTxt />
        </Text>

        <Text style={styles.slugText} numberOfLines={1}>
        <GetPointSubTxt />
        </Text>
        <PaymentPopupTxt />
      </View>
    </View>
    </View>
  );
};

const SectionHeader = ({ title }) => {
  return (
    <View style={styles.sectionHeaderContainer}>
      <Text style={styles.sectionHeaderText}>
        {title}
      </Text>
    </View>
  );
};

const SectionContent = props => {
  return (
    <View style={styles.sectionContentContainer}>
      {props.children}
    </View>
  );
};


const Color = ({ value }) => {
  if (!value) {
    return <View />;
  } else {
    return (
      <View style={styles.colorContainer}>
        <View style={[styles.colorPreview, { backgroundColor: value }]} />
        <View style={styles.colorTextContainer}>
          <Text style={styles.sectionContentText}>
            {value}
          </Text>
        </View>
      </View>
    );
  }
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
  },
  titleTextContainer1: {
    flexDirection: 'row',
    paddingTop: 25,    
    paddingHorizontal: 15
  },
  titleContainer2: {
    paddingHorizontal: 15,
    paddingBottom: 15,
    flexDirection: 'row',
  },
  sectionHeaderContainer: {
    backgroundColor: '#fbfbfb',
    paddingVertical: 8,
    paddingHorizontal: 15,
    borderWidth: StyleSheet.hairlineWidth,
    borderColor: '#ededed',
  },
  sectionHeaderText: {
    fontSize: 14,
  },
  sectionContentContainer: {
    paddingTop: 24,
    paddingBottom: 24,
    paddingHorizontal: 15,
  },
  sectionContentText: {
    color: '#808080',
    fontSize: 14,
  },
  emailText: {
    fontWeight: '600',
    fontSize: 12,
  },
  nameText: {
    fontWeight: '600',
    fontSize: 24
  },
  slugText: {
    color: '#a39f9f',
    fontSize: 14,
    backgroundColor: 'transparent',
  },
  descriptionText: {
    fontSize: 14,
    marginTop: 6,
    color: '#4d4d4d',
  },
  colorContainer: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  colorPreview: {
    width: 17,
    height: 17,
    borderRadius: 2,
    marginRight: 6,
    borderWidth: StyleSheet.hairlineWidth,
    borderColor: '#ccc',
  },
  colorTextContainer: {
    flex: 1,
  },
  priceTitle:{
    marginTop : 15,
    fontSize: 24,
    marginBottom : 15,
    color: '#ccc',
    textAlign: 'center'
  },
  price:{
    fontWeight:'bold',
    color: '#333'
  },
  subText:{ 
    fontSize: 14,
    marginBottom : 20,
    color: '#ccc',
    textAlign: 'center'
  },
  subText2:{ 
    fontSize: 17,
    marginBottom : 20,
    color: '#333',
    textAlign: 'center'
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
  textButton : {
    color : '#fff'
  }
});
