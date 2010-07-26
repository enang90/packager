<?php
class SubscriptionsController extends AppController {

	var $name = 'Subscriptions';

	function admin_index() {
		$this->Subscription->recursive = 0;
		$this->set('subscriptions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subscription', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subscription', $this->Subscription->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Subscription->create();
			if ($this->Subscription->save($this->data)) {
				$this->Session->setFlash(__('The subscription has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscription could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid subscription', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subscription->save($this->data)) {
				$this->Session->setFlash(__('The subscription has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscription could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subscription->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subscription', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subscription->delete($id)) {
			$this->Session->setFlash(__('Subscription deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subscription was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>