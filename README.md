Smoke test application for use in the OpenShift 3 Roadshow, adapted for use with Jenkins CI/CD demo using persistent storage for Jenkins and MySQL.

PHP App is still functional with out MySQL configured, and displays "User Friendly" message to that effect.  During demo, I typically use the following sequence:

1) Create Sample/Demo Project, and PHP Application from the OpenShift Web Console

2) Once Builde\/Deployment Complete, create the MySQL Backend via oc CLI (See Below)

**$ oc new-app -e MYSQL_USER='app_user',MYSQL_PASSWORD='password',MYSQL_DATABASE=sampledb registry.access.redhat.com/openshift3/mysql-55-rhel7 --name='mysql'**

Get into the mysql pod (wait until you see it created in Web Console)

$ oc rsh $(oc get pods | grep mysql | grep Running | awk '{print $1}')    # rsh will ssh into the mysql pod

$ mysql -u $MYSQL_USER -p$MYSQL_PASSWORD -h $HOSTNAME $MYSQL_DATABASE

Create sample_table in sampledb, and add some data

CREATE TABLE `sample_table` (
  `key_value` int(11) NOT NULL AUTO_INCREMENT,
  `data_value` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`key_value`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sample_table` VALUES (1,'1st data item');
INSERT INTO `sample_table` VALUES (2,'2nd data item');
INSERT INTO `sample_table` VALUES (3,'3rd data item');

Exit MySQL and Pod

3) Update the PHP Application DeploymentConfig by adding the following Environment variables to the Container Definition (see below), easiest to cut from MySQL DeploymentConfig YAML and then past to PHP Application DeploymentConfig YAML in Web Console

          env:
            -
              name: MYSQL_DATABASE
              value: sampledb
            -
              name: MYSQL_PASSWORD
              value: password
            -
              name: MYSQL_USER
              value: app_user
