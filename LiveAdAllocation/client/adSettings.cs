using UnityEngine;
using System.Collections;
using SimpleJSON;

public class adSettings : MonoBehaviour {

	private int adCount; 
	private string intOrder,vidOrder;

	// Use this for initialization
	void Start () {
		StartCoroutine(loadAdSettings());
	}

	IEnumerator loadAdSettings(){
		print ("Checking for new Ad Settings!");
		// Get the JSON from the server
		var adInfo = "http://SERVER/theJSON.json";
		var theWWW = new WWW(adInfo);
		yield return theWWW;
		var J = JSON.Parse (theWWW.text.ToString());
		print (J);
#if UNITY_IOS
		// Get the iOS Data
		adCount = int.Parse(J ["iOS"] ["Count"].Value);
		intOrder = J ["iOS"] ["Int_Order"].Value;
		vidOrder = J ["iOS"] ["Vid_Order"].Value;
#elif UNITY_ANDROID
		// Get the Android Data
		adCount = int.Parse(J ["Android"] ["Count"].Value);
		intOrder = J ["Android"] ["Int_Order"].Value;
		vidOrder = J ["Android"] ["Vid_Order"].Value;
#endif
		print ("The adCount is " + adCount);
		print ("The Int Order is " + intOrder);
		print ("The Vid Order is " + vidOrder);

	}

}
