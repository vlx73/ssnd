import { Router }         from 'express';
import { UserController } from '../controllers/UserController.js';

const router         = Router();
const userController = new UserController();

router.get   ('/',    (req, res, next) => userController.index(req, res, next));
router.get   ('/:id', (req, res, next) => userController.show(req, res, next));
router.post  ('/',    (req, res, next) => userController.store(req, res, next));
router.delete('/:id', (req, res, next) => userController.destroy(req, res, next));

export default router;
