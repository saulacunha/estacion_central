import paho.mqtt.client as mqtt

client = mqtt.Client(clean_session=True)
client.connect("192.168.1.133", 1883, 60)
# client.publish('garden/node/1/air_temperature', 5.4)
# client.publish('garden/node/1/air_humidity', 5.4)
# client.publish('garden/node/1/ground_humidity', 5.4)
# client.publish('garden/node/1/light', 5.4)
# client.publish('garden/node/1/battery_level', 0)
# client.publish('garden/node/1/water', 0)
client.publish('garden/node/1/exc', 1.2, retain=True, qos=1)
client.publish('garden/displayed', b"Hola")
