import { StyleSheet, Platform } from 'react-native';

const styles = StyleSheet.create({
  Home: {
    flex: 1,
    backgroundColor: '#EEE',
    paddingTop: 22,
    paddingLeft: 10,
    paddingRight: 10
  },
  Button: {
    paddingHorizontal: 10
  },
  Input: {
    backgroundColor: '#4A90E2',
    height: 50,
    paddingLeft: 10,
    alignItems: 'center',
    marginVertical: 20,
    color: '#FFF',
    fontSize: 18
  },
  List_Empty: {
    alignItems: 'center',
    justifyContent: 'center',
    height: 100,
    paddingTop : Platform.OS === 'ios' ? 0 : 70
  },
  List_FlatList: {
    paddingTop : Platform.OS === 'ios' ? 0 : 70
  },
  List_EmptyText: {
    fontSize: 24,
    color: '#DDD'
  },
  ListItem: {
    backgroundColor: '#fff',
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 10,
    minHeight: 50,
    paddingVertical: 10,
    width : 350,
    justifyContent: 'center',
  },
  ListItem_TextContainer: {
    flex: 1
  },
  ListItem_Text: {
    color: '#4A4A4A',
    fontSize: 16,
    
  },
  ListItem_Checked: {
    color: '#9B9B9B',
    textDecorationLine: 'line-through'
  }
});

export default styles;