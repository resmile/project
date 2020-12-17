
import firebase from "firebase";

// Initialize Firebase
const firebaseConfig = {
    apiKey: "xxx",
    authDomain: "xxx.firebaseapp.com",
    databaseURL: "https://xxx.firebaseio.com",
    projectId: "xxx",
    storageBucket: "xxx.appspot.com",
    messagingSenderId: "1234"
};
const firebaseApp = firebase.initializeApp(firebaseConfig);

export const db = firebaseApp.database();
export const auth = firebaseApp.auth();
export const user = auth.currentUser;
export const timeRef = firebase.database.ServerValue.TIMESTAMP;

const date = new Date();


export let yy = () => {
    const date = new Date();
    return date.getFullYear();
}
export let mm = () => {
    const date = new Date();
    return date.getMonth()+1;
}
export let dd = () => {
    const date = new Date();
    return date.getDate();
}
export let h = () => {
    const date = new Date();
    return date.getHours();
}
export let m = () => {
    const date = new Date();
    return date.getMinutes();
}
export let s = () => {
    const date = new Date();
    return date.getSeconds();
}
export default firebaseApp;