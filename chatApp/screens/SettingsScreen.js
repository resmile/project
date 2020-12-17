import React from 'react';
import { Alert,SectionList, StyleSheet, Text, View, TouchableOpacity } from 'react-native';
import { auth, db } from '../components/firebaseConfig.js';

export default class SettingsScreen extends React.Component {
  static navigationOptions = ({navigation, navigationOptions}) => {
    const params = navigation.state.params || {};
    return { 
    headerTitle: '도움말'
   };
  };

  constructor(props) {
    super(props);
    this.state = {
      point : ''
    }
    var user = auth.currentUser;
    var roomId = user.uid;
    this.logout = this.logout.bind(this);
  }

  render() {
    const sections = [
      {
        data: [
          { 
            value: '이용안내',
            type : 'guide',
          },
          { 
            value: '자주찾는질문(FAQ)',
            type : 'faq'
          },
          { 
            value: '공지사항',
            type : 'notice'
          }
        ],
        title: '이용안내',
      },
      {
        data: [
          { 
            value: '개인정보취급방침',
            type : 'policy',
          },
          { 
            value: '이용약관',
            type : 'terms'
          }
        ],
        title: '약관',
      },
      {
        data: [
          { 
            value: '비밀번호 초기화',
            type : 'resetPwd',
          },
          { 
            value: '로그아웃',
            type : 'logout',
          },
        ],
        title: '내 계정',
      },
    ]; 

    return (
      <SectionList
        style={styles.container}
        renderItem={this._renderItem}
        renderSectionHeader={this._renderSectionHeader}
        stickySectionHeadersEnabled={true}
        keyExtractor={(item, index) => index}
        sections={sections}
      />
    );
  }

  logout = () => {
    const { navigate } = this.props.navigation;
    Alert.alert(
      '로그아웃',
      '로그아웃할까요?',
      [
        {text: 'Cancel', onPress: () => console.log('Cancel Pressed'), style: 'cancel'},
        {text: 'OK', onPress: () => {

          auth.signOut();
          navigate('Login');
      }},
      ],
      { cancelable: false }
    )
  };

  resetPassword = () => {
    Alert.alert(
      '비밀번호 초기화',
      '비밀번호 재설정을 위한 이메일이 발송됩니다.\n새로 설정된 비밀번호는 로그아웃된 이후에 이용하실 수 있어요.',
      [
        {text: 'Cancel', onPress: () => console.log('Cancel Pressed'), style: 'cancel'},
        {text: 'OK', onPress: () => {
          var email = auth.currentUser.email;
    auth.languageCode = 'ko';
    auth.sendPasswordResetEmail(email).then(function() {
      alert('이메일이 정상적으로 발송되었습니다. \n 발송된 메일에서 비밀번호를 재설정해주세요.');
    }).catch(function(error) {
      alert('이메일 발송이 실패하였습니다.'+error);
    });
      }},
      ],
      { cancelable: false }
    )


    
  };

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


  _handlePressGuide = () => {
    this.props.navigation.navigate('WebView', {
      uri: 'http://2tai.kr/footer/guide.php',
      title: '이용안내',
    });
  };

  _handlePressFaq = () => {
    this.props.navigation.navigate('WebView', {
      uri: 'http://2tai.kr/customer/faq.php',
      title: 'FAQ',
    });
  };

  _handlePressNotice = () => {
    this.props.navigation.navigate('WebView', {
      uri: 'http://2tai.kr/customer/notice/list.php?table=notice&page=1',
      title: '공지사항',
    });
  };

  _renderSectionHeader = ({ section }) => {
    return <SectionHeader title={section.title} />;
  };

  _renderItem = ({ item }) => {

    if (item.type === 'logout') {
      return (
        <SectionContent>
          <TouchableOpacity onPress={this.logout.bind(this)}>
            <Text style={styles.sectionContentText}>{item.value}</Text>
          </TouchableOpacity>
        </SectionContent>
      );
    }else if(item.type === 'policy'){
      return(
      <SectionContent>
          <TouchableOpacity onPress={this._handlePressPolicy.bind(this)}>
            <Text style={styles.sectionContentText}>{item.value}</Text>
          </TouchableOpacity>
        </SectionContent>
      );
    }else if(item.type === 'terms'){
      return(
      <SectionContent>
          <TouchableOpacity onPress={this._handlePressTerms.bind(this)}>
            <Text style={styles.sectionContentText}>{item.value}</Text>
          </TouchableOpacity>
        </SectionContent>
      );
    }else if (item.type === 'resetPwd') {
      return (
        <SectionContent>
          <TouchableOpacity onPress={this.resetPassword.bind(this)}>
            <Text style={styles.sectionContentText}>{item.value}</Text>
          </TouchableOpacity>
        </SectionContent>
      );
    }else if(item.type === 'guide'){
      return(
      <SectionContent>
          <TouchableOpacity onPress={this._handlePressGuide.bind(this)}>
            <Text style={styles.sectionContentText}>{item.value}</Text>
          </TouchableOpacity>
        </SectionContent>
      );
    }else if(item.type === 'faq'){
      return(
      <SectionContent>
          <TouchableOpacity onPress={this._handlePressFaq.bind(this)}>
            <Text style={styles.sectionContentText}>{item.value}</Text>
          </TouchableOpacity>
        </SectionContent>
      );
    }else if(item.type === 'notice'){
      return(
      <SectionContent>
          <TouchableOpacity onPress={this._handlePressNotice.bind(this)}>
            <Text style={styles.sectionContentText}>{item.value}</Text>
          </TouchableOpacity>
        </SectionContent>
      );
    }
    else {
      return (
        <SectionContent>
          <Text style={styles.sectionContentText}>
            {item.value}
          </Text>
        </SectionContent>
      );
    }
  };
}

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
});
