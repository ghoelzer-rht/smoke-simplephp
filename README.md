Smoke test application for use in the OpenShift 3 Roadshow, adapted for use with Jenkins CI/CD demo using persistent storage for Jenkins and MySQL.

Notes/Thoughts on current DevOps Lifecycle strategies being tested and technical implementations and ideas:

Used git pre-push hook and curl command to trigger Jenkins build with parameters (see .git/hooks).
Updated OSE buildConfig to be only manually triggered, leaving anything else seemed to cause two builds to be triggered after initial Jenkins builed triggered with git pre-push hook.
Experimented with "oc tag" command, but didn't work as expected, tags always point to ":latest" image.  Found command to pull back full image name by ReplicationController id, which is tied to a specific build/deployment.  Experimented with template using the full image reference, and was successfully able to create new app from a specific build.  Will attempt to leverage this to automate the creation of a new "release candidate" for testing after successful build and unit test.  Then use this to update "live/production" app DeploymentConfig when "release candidate" has been successfully tested and is to be promoted.
