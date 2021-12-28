import paho.mqtt.client as mqtt

def on_connect(client, userdata, flags, rc):
    print("Connected with result code "+str(rc))
    client.subscribe("garden/#")

def on_message(client, userdata, msg):
    print(msg.topic+" "+str(msg.payload))

client = mqtt.Client(clean_session=True)
client.on_connect = on_connect
client.on_message = on_message

# client.tls_set("/Users/saulfranciscoacunagodoy/PycharmProjects/estacion_central/local_credentials/ca.crt")
# client.tls_insecure_set(True)
client.username_pw_set('station', 'station01')
client.connect("192.168.1.134", 1883, 60)
client.loop_forever()