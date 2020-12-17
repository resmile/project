import FirebaseConstants from "./FirebaseConstants";

const API_URL = "https://fcm.googleapis.com/fcm/send";

class FirebaseClient {

  async send(body, type) {
		if(FirebaseClient.KEY === 'YOUR_API_KEY'){
			console.log('Set your API_KEY in app/FirebaseConstants.js')
			return;
		}
  	let headers = new Headers({
  		"Content-Type": "application/json",
      "Authorization": "key=" + FirebaseConstants.KEY
  	});

		try {
			let response = await fetch(API_URL, { method: "POST", headers, body });
			console.log(response);
			try{
				response = await response.json();
				if(!response.success){
					console.log('Failed to send notification, check error log')
				}
			} catch (err){
				console.log('Failed to send notification, check error log')
			}
		} catch (err) {
			console.log(err && err.message)
		}
  }

}

let firebaseClient = new FirebaseClient();
export default firebaseClient;
