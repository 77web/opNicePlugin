<?php

//remover
$this->dispatcher->connect('op_action.post_execute_diary_delete', array("opNicePluginNiceRemover", "listenToDiaryDelete"));
$this->dispatcher->connect('op_action.post_execute_communityEvent_delete', array("opNicePluginNiceRemover", "listenToCommunityEventDelete"));
$this->dispatcher->connect('op_action.post_execute_communityTopic_delete', array("opNicePluginNiceRemover", "listenToCommunityTopicDelete"));