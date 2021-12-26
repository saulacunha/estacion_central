IP="192.168.1.133"
SUBJECT_CA="/C=SE/ST=Stockholm/L=Stockholm/O=himinds/OU=CA/CN=$IP"
SUBJECT_SERVER="/C=SE/ST=Stockholm/L=Stockholm/O=himinds/OU=Server/CN=$IP"
SUBJECT_CLIENT="/C=SE/ST=Stockholm/L=Stockholm/O=himinds/OU=Client/CN=$IP"

function generate_CA () {
   echo "$SUBJECT_CA"
   openssl genrsa -des3 -out ca.key 4096
   openssl req -x509 -new -nodes -key ca.key -sha256 -subj "$SUBJECT_CA" -days 3650 -out ca.crt
}

function generate_server () {
   echo "$SUBJECT_SERVER"
   openssl genrsa -out server.key 2048
   openssl req -new -subj "$SUBJECT_SERVER" -key server.key -out server.csr
   openssl x509 -req -in server.csr -CA ca.crt -CAkey ca.key -CAcreateserial -out server.crt -days 3650 -sha256
}

#function generate_client () {
#   echo "$SUBJECT_CLIENT"
#   openssl req -new -nodes -sha256 -subj "$SUBJECT_CLIENT" -out client.csr -keyout client.key
#   openssl x509 -req -sha256 -in client.csr -CA ca.crt -CAkey ca.key -CAcreateserial -out client.crt -days 365
#}

generate_CA
generate_server
#generate_client