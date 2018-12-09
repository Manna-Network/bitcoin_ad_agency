In order for the enterprise level agent to receive updates from the Manna Network it is necessary for them to create a secure connection by installing client software from the Pusher website. The Pusher client files will be included in the package and will be configured already except for user authorization. 

It will receive the "pool of peers" of the other agents from The Manna Network that they will be able to listen in on to receive updates.


How do I handle that? All enterprise levels will be members, will have link ids but will have to go through an additional registration process to acquire an agent id.

Since all the client does is receive, we probably don't need any auth? The 'pool of peers" will have to be generated by central and sent through the central server to this folder also. The folder will have to parse the data coming from the network and insert it into the tables. 

There will need to be separate logic for the data coming from the peers. Will they be able to send "pool of peers" candidates?

The sql will have to use the install/db_write_config/db_root_auth.php 